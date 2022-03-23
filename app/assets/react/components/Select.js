import React, { Component } from "react";
import { colourOptions } from "./data.js";
import { default as ReactSelect } from "react-select";
import "./styles.css";
import { components } from "react-select";

const Option = (props) => {
    return (
        <div>
            <components.Option {...props}>
                <input
                    type="checkbox"
                    checked={props.isSelected}
                    onChange={() => null}
                />{" "}
                <label>{props.label}</label>
            </components.Option>
        </div>
    );
};

export default class Select extends Component {
    constructor(props) {
        super(props);
        this.state = {
            optionSelected: null
        };
    }

    handleChange = (selected) => {
        this.setState({
            optionSelected: selected
        });
    };

    render() {
        return (
            <span
                className="d-inline-block"
                data-toggle="popover"
                data-trigger="focus"
                data-content="Please selecet account(s)"
            >
        <ReactSelect
            options={colourOptions}
            isMulti
            closeMenuOnSelect={false}
            hideSelectedOptions={false}
            components={{
                Option
            }}
            onChange={this.handleChange}
            allowSelectAll={true}
            value={this.state.optionSelected}
        />
      </span>
        );
    }
}