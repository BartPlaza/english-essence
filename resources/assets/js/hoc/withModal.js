import React from 'react';
import './withModal.css';

const withModal = (Component) => {
    return class extends React.Component {
        constructor(props) {
            super(props);
            this.state = {
                active: false,
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
                            <Component {...this.props} closeModal={this.closeModal}/>
                        </div>
                    </div>
                    {this.state.active && <button className="modal-close is-large" aria-label="close" onClick={this.closeModal}/>}
                </React.Fragment>
            )
        }
    }
};

export default withModal;