import React from 'react';
import ReactDOM from 'react-dom';
import './Modal.css';

class Modal extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            active: false,
            properties: {
                body: null,
                language: 'pl'
            },
            errors: {
                body: null,
                language: null
            }
        }
    }

    closeModal = () => {
        this.setState({
            active: false,
        })
    };

    showModal = () => {
        this.setState({
            active: true,
        });
        this.clearErrors();
    };

    clearErrors = () => {
        this.setState({
            errors: {
                body: null,
                language: null
            }
        })
    };

    updateProperty = (event) => {
        let properties = {...this.state.properties};
        properties[event.target.name] = event.target.value;
        this.setState({
            properties: properties
        })
    };

    save = () => {
        this.clearErrors();
        axios.post('/words', this.state.properties)
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
        const modalClasses = ['modal'];
        if (this.state.active) {
            modalClasses.push('is-active');
        }

        return (
            <React.Fragment>
                <i className="fas fa-plus open_modal_button" onClick={this.showModal}></i>
                <div className={modalClasses.join(' ')}>
                    <div className="modal-background"></div>
                    <div className="modal-content">
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
                                                    value={this.state.properties.language}>
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
                                    <button className="button" tabIndex="4" onClick={this.closeModal}>Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button className="modal-close is-large" aria-label="close" onClick={this.closeModal}/>
                </div>
            </React.Fragment>
        )
    }
}

if (document.getElementById('Modal')) {
    ReactDOM.render(<Modal/>, document.getElementById('Modal'));
}

export default Modal;