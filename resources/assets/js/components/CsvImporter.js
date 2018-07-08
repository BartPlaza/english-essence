import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import styles from './CsvImporter.css';

class CsvImporter extends Component {
    constructor(props) {
        super(props);
        this.state = {
            isFileOk: false,
            fileInput: React.createRef(),
            errors: null,
            importResults: null
        }
    };

    validateFile = () => {
        const formData = new FormData();
        formData.append('file', this.state.fileInput.current.files[0]);
        axios.post('/import_csv/validate', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
            .then((response) => {
                this.setState({
                    errors: null,
                    isFileOk: true,
                    importResults: null
                })
            })
            .catch((e) => {
                console.log(e.response.data.errors);
                let errors = [];
                e.response.data.errors.file.forEach((error) => {
                    errors.push(error);
                });
                this.setState({
                    isFileOk: false,
                    errors: errors,
                    importResults: null
                });
            });
    };

    importWords = (event) => {
        event.preventDefault()
        const formData = new FormData();
        formData.append('file', this.state.fileInput.current.files[0]);
        axios.post('/import_csv/import', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then((response) => {
            this.setState({
                importResults: response.data,
                isFileOk: false
            })
        }).catch((e) => {
            console.log(e);
            this.setState({
                errors: ['An error has occured!'],
                isFileOk: false
            })
        });
    };

    render() {
        return (
            <form className="card" encType="multipart/form-data">
                <div className="card-content">
                    <p className="title">Import words </p>
                    <p className="subtitle"> 1. Prepare your file </p>
                    <p>
                        Your file should have 2 columns separated by ',' <br/>
                        First column is polish word and second english
                    </p>
                    <p className="subtitle"> 2. Choose .csv file </p>
                    <div className="file">
                        <label className="file-label">
                            <input className="file-input" type="file" name="resume" ref={this.state.fileInput}
                                   onChange={(event) => {
                                       this.validateFile(event);
                                   }}/>
                            <span className="file-cta">
                            <span className="file-icon">
                                <i className="fas fa-upload"></i>
                            </span>
                            <span className="file-label">
                            Choose a file…
                            </span>
                            </span>
                            <span className="csv-file-check">
                                {this.state.isFileOk ? <i className="fas fa-check"></i> : null}
                                {this.state.errors ? <i className="fas fa-exclamation-triangle"></i> : null}
                            </span>
                        </label>
                    </div>
                </div>
                <div className="card-footer">
                    {this.state.isFileOk ?
                        <button className="button is-info" id="import-button" onClick={this.importWords}>Start
                            importing</button> : null}
                    {this.state.errors ? this.state.errors.map((error) => {
                        return <div className="import-alert" key={error}>{error}</div>
                    }) : null}
                    {this.state.importResults ? <div className="import-results">
                        <div><i className="fas fa-binoculars"></i> Found: {this.state.importResults['found']}</div>
                        <div><i className="fas fa-save"></i> Saved: {this.state.importResults['saved']}</div>
                        <div><i className="fas fa-clone"></i> Duplicated: {this.state.importResults['duplicated']}</div>
                    </div> : null}
                </div>
            </form>
        );
    }
}

if (document.getElementById('CsvImporter')) {
    ReactDOM.render(<CsvImporter/>, document.getElementById('CsvImporter'));
}

export default CsvImporter;