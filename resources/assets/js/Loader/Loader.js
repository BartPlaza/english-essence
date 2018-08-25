import React from 'react';
import ReactDOM from 'react-dom';
import './Loader.css';

const loader = (props) => {
    return (
        <div className="spinner">
            <div className="bounce1"/>
            <div className="bounce2"/>
            <div className="bounce3"/>
        </div>
    )
};

if (document.getElementById('Loader')) {
    ReactDOM.render(<Loader/>, document.getElementById('Loader'));
}

export default loader;

