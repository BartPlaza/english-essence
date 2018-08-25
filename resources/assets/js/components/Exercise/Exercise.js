import React from 'react';
import ReactDOM from 'react-dom';
import './Exercise.css';
import ExerciseNavigation from './ExerciseNavigation';
import Progress from '../../Progress/Progress';
import Loader from '../../Loader/Loader';

class Exercise extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            words: null,
            translations: null,
            count: 0,
            beforeAnswer: true,
            answer: '...'
        }
    }

    componentDidMount() {
        const words = JSON.parse(this.props.words).map((word) => {
            return word.body;
        });
        axios.post('/exercises/translateAll', {
            words: words,
            from: this.props.from,
            to: this.props.to
        })
            .then((response) => {
                const translations = response.data.outputs.map((word) => {
                    return {
                        word: word.output,
                        inDictionary: true
                    };
                });
                this.setState({
                    words: words,
                    translations: translations
                });
                this.areInDictionary(translations);
            })
            .catch((error) => {
                console.log(error);
            });
    }

    areInDictionary = (translations) => {
        translations.forEach((translation, index) => {
            console.log(translation);
            axios.post('/words/exists', {
                word: translation.word,
                lang: this.props.to
            })
                .then((response) => {
                    translation.inDictionary = response.data;
                    let copyTranslations = this.state.translations;
                    copyTranslations[index] = translation;
                    this.setState({
                        translations: copyTranslations
                    });
                })
                .catch((error) => {
                    console.log(error);
                })
        });
    };

    showTranslation = () => {
        this.setState({
            answer: this.state.translations[this.state.count]['word'],
            beforeAnswer: false,
        });
    };

    nextWord = () => {
        if (this.state.count >= 9) return false;
        this.setState((prevState) => {
            return {
                count: ++prevState.count,
                answer: '...',
                beforeAnswer: true
            }
        });
    };

    prevWord = () => {
        if (this.state.count <= 0) return false;
        this.setState((prevState) => {
            return {
                count: --prevState.count,
                answer: '...',
                beforeAnswer: true
            }
        });
    };

    cancelExercise = () => {
        location.replace('/exercises');
    };

    finishExercise = () => {
        location.replace('/exercises?exercise=finished');
    };

    saveWord = () => {
        axios.post('/words', {
            body: this.state.translations[this.state.count]['word'],
            language: this.props.to
        })
            .then((response) => {
                let copyTranslations = this.state.translations;
                copyTranslations[this.state.count]['inDictionary'] = true;
                this.setState({
                    translations: copyTranslations
                });
            })
            .catch((error) => {
                console.log(error);
            })
    };

    shouldRenderSaver = () => {
        return (!this.state.beforeAnswer && !this.state.translations[this.state.count]['inDictionary']);
    };

    render() {

        const answerClass = ['exercise-fragment', 'exercise-answer'];
        if (this.shouldRenderSaver()) answerClass.push('with-margin-move');

        return (
            <div className="box exercise-wrapper">
                {this.state.words ? (
                    <React.Fragment>
                        <div className="exercise-fragment exercise-question">
                            {this.state.words[this.state.count]}
                        </div>
                        <div className="control exercise-fragment">
                            <ExerciseNavigation currentPosition={this.state.count}
                                                maxPosition={this.state.words.length - 1}
                                                beforeAnswer={this.state.beforeAnswer}
                                                showTranslation={this.showTranslation}
                                                cancelExercise={this.cancelExercise}
                                                finishExercise={this.finishExercise}
                                                nextWord={this.nextWord}
                                                prevWord={this.prevWord}/>
                        </div>
                        <div className={answerClass.join(' ')}>
                            <span>{this.state.answer}</span>
                            {this.shouldRenderSaver() ? <i className="far fa-save exercise-add-word has-text-primary"
                                                           onClick={() => this.saveWord()}/> : null}
                        </div>
                        <div className="exercise-fragment">
                            <Progress value={this.state.count} max={this.state.words.length - 1}/>
                        </div>
                    </React.Fragment>
                ) : (
                    <Loader/>
                )}
            </div>
        )
    }
}


if (document.getElementById('exerciseComponent')) {
    const componentHandle = document.getElementById('exerciseComponent');
    const props = Object.assign({}, componentHandle.dataset);
    ReactDOM.render(<Exercise {...props}/>, document.getElementById('exerciseComponent'))
}

export default Exercise;
