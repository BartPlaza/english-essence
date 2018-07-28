import React from 'react';
import ReactDOM from 'react-dom';
import styles from './Exercise.css';

class Exercise extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            words: [],
            translations: [],
            count: 0,
            nextWord: false,
            answer: '...'
        }
    }

    componentDidMount() {
        const words = JSON.parse(this.props.words).map((word) => {
            return word.body;
        });
        axios.post('/exercises/translateAll', {
            words: words
        })
            .then((response) => {
                const translations = response.data.outputs.map(($word) => {
                    return $word.output;
                });
                this.setState({
                    words: words,
                    translations: translations
                });
            })
            .catch((error) => {
                console.log(error);
            });
    }

    showTranslation = () => {
        this.setState({
            answer: this.state.translations[this.state.count],
            nextWord: true,
        })
    };

    nextWord = () => {
        if (this.state.count >= 9) return false;
        this.setState((prevState) => {
            return {
                count: ++prevState.count,
                answer: '...',
                nextWord: false
            }
        });
    };

    prevWord = () => {
        if (this.state.count <= 0) return false;
        this.setState((prevState) => {
            return {
                count: --prevState.count,
                answer: '...',
                nextWord: false
            }
        });
    };

    finishExercise = () => {
      location.replace('/exercises?exercise=finished');
    };

    render() {
        return (
            <div className="box exercise-wrapper">
                <div className="exercise-question">
                    {this.state.words[this.state.count]}
                </div>
                <div className="control">
                    {this.state.nextWord ? (
                        <React.Fragment>
                            <i className="far fa-arrow-alt-circle-left exercise-nav" onClick={this.prevWord}></i>
                            {this.state.count === (this.state.words.length - 1) ? <i className="far fa-check-circle exercise-nav has-text-success" onClick={this.finishExercise}></i> : <i className="far fa-arrow-alt-circle-right exercise-nav" onClick={this.nextWord}></i>}
                        </React.Fragment>
                    ) : (
                        <i className="fas fa-exchange-alt exercise-nav rotated" onClick={this.showTranslation}></i>
                    )}
                </div>
                <div className="exercise-answer">
                    {this.state.answer}
                </div>
                <div>
                    <progress className="progress is-primary" value={this.state.count}
                              max={this.state.words.length - 1}>
                    </progress>
                </div>
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
