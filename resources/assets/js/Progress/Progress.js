import React from 'react';

const progress = (props) => {
    return (
        <progress className="progress is-primary" value={props.value}
                  max={props.max}>
        </progress>
    )
};

export default progress;