import React from 'react';
import './ExerciseNavigation.css';

const exerciseNavigation = (props) => {
    if (props.beforeAnswer) {
        return (
            <i className="fas fa-exchange-alt exercise-nav rotated" onClick={props.showTranslation}></i>
        )
    }
    return (
        <React.Fragment>
            {props.currentPosition <= 0 ? (
                <i className="far fa-times-circle exercise-nav has-text-danger"
                   onClick={props.cancelExercise}></i>
            ) : (
                <i className="far fa-arrow-alt-circle-left exercise-nav" onClick={props.prevWord}></i>
            )}
            {props.currentPosition >= props.maxPosition ? (
                <i className="far fa-check-circle exercise-nav has-text-success"
                   onClick={props.finishExercise}></i>
            ) : (
                <i className="far fa-arrow-alt-circle-right exercise-nav" onClick={props.nextWord}></i>
            )}
        </React.Fragment>
    )
};

export default exerciseNavigation;