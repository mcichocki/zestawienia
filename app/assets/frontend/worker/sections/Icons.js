import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";

class Icons extends React.Component
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
                    {/*<div className="card-body">*/}
                        {/*<h6 className="card-title">Lista jednostek</h6>*/}
                        {/*<ul>*/}
                        {/*    <li className="card-text">Centrum Promocji Zdrowia i Edukacji Ekologicznej Dzielnicy Bemowo m.st. Warszawy</li>*/}
                        {/*</ul>*/}

                        {/*<a href="#" className="btn btn-sm btn-primary">Zobacz dane </a>*/}
                    {/*</div>*/}
                </div>
            </div>

            {/*<div className="col-12 col-sm-6 col-md-3 mb-2">*/}
            {/*    <a href="#">*/}
            {/*    <div className="info-box">*/}
            {/*    */}
            {/*        <span className="info-box-icon bg-info elevation-1"><i className="fas fa-inbox"></i></span>*/}
            {/*        <div className="info-box-content">*/}
            {/*            <span className="info-box-text">Ilość zestawień</span>*/}
            {/*            <span className="info-box-number">*/}
            {/*            840*/}
            {/*            /!* <small>%</small> *!/*/}
            {/*            </span>*/}
            {/*        </div>*/}
            {/*    </div>*/}
            {/*    </a>*/}
            {/*</div>*/}

            {/*<div className="col-12 col-sm-6 col-md-3">*/}
            {/*    <a href="#">*/}
            {/*    <div className="info-box mb-3">*/}
            {/*    <span className="info-box-icon bg-warning elevation-1"><i className="fas fa-user-check"></i></span>*/}

            {/*    <div className="info-box-content">*/}
            {/*        <span className="info-box-text">W trakcie akceptacji</span>*/}
            {/*        <span className="info-box-number">36</span>*/}
            {/*    </div>*/}
            {/*    </div>*/}
            {/*    </a>*/}
            {/*</div>*/}

            {/*<div className="clearfix hidden-md-up"></div>*/}

            {/*<div className="col-12 col-sm-6 col-md-3">*/}
            {/*    <a href="#">*/}
            {/*    <div className="info-box mb-3">*/}
            {/*    <span className="info-box-icon bg-success elevation-1"><i className="fas fa-check"></i></span>*/}
            {/*    <div className="info-box-content">*/}
            {/*        <span className="info-box-text">Zakończonych</span>*/}
            {/*        <span className="info-box-number">760</span>*/}
            {/*    </div>*/}
            {/*    </div>*/}
            {/*    </a>*/}
            {/*</div>*/}

            {/*<div className="col-12 col-sm-6 col-md-3">*/}
            {/*    <a href="#">*/}
            {/*    <div className="info-box mb-3">*/}
            {/*    <span className="info-box-icon bg-danger elevation-1"><i className="fas fa-pencil-alt"></i></span>*/}
            {/*        <div className="info-box-content">*/}
            {/*            <span className="info-box-text">Do poprawy</span>*/}
            {/*            <span className="info-box-number">41</span>*/}
            {/*        </div>*/}
            {/*    </div>*/}
            {/*    </a>*/}
            {/*</div>*/}
    
           
        </div>
        );
    }
}

export default Icons;
