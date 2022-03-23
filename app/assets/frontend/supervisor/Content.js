import React from 'react';
import axios from 'axios';
import routing from "../website/routings";

let identyfikator = $('#identyfikator').val();

class Content extends React.Component
{
    constructor(props) {
        super(props);
        this.state = {
            jednostki: []
        };
    }

    componentDidMount() {
        this.getJednostki();
    }

    getJednostki() {
        axios.post('/jednostki/get', identyfikator
        ).then(res => {
            const jednostki = res.data;
            this.setState({ jednostki })
        })
    }

    render() {
        return(
            <div className="row">
                <div className="col-lg-6 mb-2">
                    <div className="card card-primary card-outline">
                        <div className="card-header">
                            <h5 className="m-0">Dzielnica Bemowo</h5>
                        </div>
                        <div className="card-body">
                            <h6 className="card-title">Lista jednostek:</h6>
                            <ul>
                                {this.state.jednostki.map(item =>
                                    <li className="card-text" key={item.id}><a href={routing.get("zestawienia_archiwum")+0+"/"+item.id}>{item.nazwa}</a></li>
                                )}
                            </ul>
                            <br/>
                            <a href={routing.get("jednostki_worker")} className="btn btn-sm btn-primary">Lista jednostek</a>
                        </div>
                    </div>
                </div>
                <div className="col-lg-6 mb-2">
                    <div className="card card-primary card-outline">
                        <div className="card-header">
                            <h5 className="m-0">Dzielnica Bemowo, suma w poszczególnych jednostkach</h5>
                        </div>
                        <div className="card-body">
                            <div className="chart">
                                <canvas id="pieChart" style={{minHeight: "250px", height: "250px", maxHeight: "250px", maxWidth: "100%"}}></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-lg-12">
                    <div className="card card-primary card-outline">
                        <div className="card-body">
                            <div className="card card-header">
                                <div className="card-header">
                                    <h3 className="card-title">Wykres zestawienia</h3>
                                </div>
                                <div className="card-body">
                                    <div className="chart">
                                        <canvas id="barChart" style={{minHeight: "250px", height: "250px", maxHeight: "250px", maxWidth: "100%"}}></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Content;


