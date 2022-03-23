import React from 'react';
import './loadButton.css';

export const LoadButton = (props) => (
  <button
    className="load-button btn btn-sm btn-primary"
    onClick={props.onLoad}
  >
    {props.title}
  </button>
);