import React from 'react';
import ReactDOM from 'react-dom';
import withModal from '../../hoc/withModal';

class AddWordForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            fields: {
                body: null,
                language: 'pl'
            },
            errors: {
                body: null,
                language: null
            }
        }
    }

    clearErrors = () => {
        this.setState({
            errors: {
                body: null,
                language: null
            }
        })
    };

    updateProperty = (event) => {
        let properties = {...this.state.fields};
        properties[event.target.name] = event.target.value;
        this.setState({
            fields: properties
        })
    };

    save = () => {
        this.clearErrors();
        axios.post('/words', this.state.fields)
            .then(() => {
                location.reload();
            })
            .catch((error) => {
                this.setState({
                    errors: error.response.data.errors
                });
            });
    };

    render() {
        return (
            <div className="box">
                <div className="field is-horizontal">
                    <div className="field-label is-normal">
                        <label className="label" htmlFor="body">Word</label>
                    </div>
                    <div className="field-body">
                        <div className="field">
                            <div className="control">
                                <input className="input" id="body" type="text" name="body" tabIndex="1"
                                       placeholder="Enter word..." onChange={this.updateProperty}/>
                                {this.state.errors.body ? (
                                    <p className="help is-danger" role="alert">
                                        <strong>{this.state.errors.body[0]}</strong>
                                    </p>
                                ) : null
                                }
                            </div>
                        </div>
                    </div>
                </div>
                <div className="field is-horizontal">
                    <div className="field-label is-normal">
                        <label className="label">Language</label>
                    </div>
                    <div className="field-body">
                        <div className="control">
                            <div className="select is-fullwidth">
                                <select tabIndex="2" name="language" onChange={this.updateProperty}
                                        value={this.state.fields.language}>
                                    <option>pl</option>
                                    <option>en</option>
                                </select>
                            </div>
                            {this.state.errors.language ? (
                                <p className="help is-danger" role="alert">
                                    <strong>{this.state.errors.language[0]}</strong>
                                </p>
                            ) : null
                            }
                        </div>
                    </div>
                </div>
                <div className="field is-grouped is-grouped-right">
                    <div className="buttons">
                        <button className="button is-lightblue" tabIndex="3" onClick={this.save}>Add
                            word
                        </button>
                        <button className="button" tabIndex="4" onClick={this.props.closeModal}>Cancel
                        </button>
                    </div>
                </div>
            </div>
        )
    }
}

if (document.getElementById('AddWordForm')) {

    const ModalAddWordForm = withModal(AddWordForm);

    ReactDOM.render(<ModalAddWordForm/>, document.getElementById('AddWordForm'));
}

export default AddWordForm;