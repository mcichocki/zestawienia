import React from 'react';
import axios from "axios";

class Header extends React.Component
{
    constructor(props) {
        super(props);
        this.state = {
            value: ''
        };
    }

    value = axios.get('/settings/default')
        .then(res => {
            const value = res.data;
            this.setState({ value });
        })

    render() {
        return(
            <div className="row">
                <div className="col-lg-12 mb-2">
                    <div className="card card-outline">
                        <div className="card-header">
                            <h5 className="m-0" style={{color:"#172b4d !important"}}>Rok zestawieniowy: {this.state.value}</h5>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Header;
