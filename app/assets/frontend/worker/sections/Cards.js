import React from 'react';
import ReactDOM from 'react-dom';

class Cards extends React.Component
{
    // state = {
    //     uzytkownicy: []
    // }

    // componentDidMount()
    // {
    //     axios.get(routing.get('api_users')).then(res => {
    //         const uzytkownicy = res.data;
    //         this.setState({ uzytkownicy });
    //     });
    // }

    render() {
        return(
            <div className="row">
                <div className="col-lg-3 col-6">
                    <div className="small-box bg-info">
                        <div className="inner">
                        <h3>150</h3>
                        <p>New Orders</p>
                        </div>
                        <div className="icon">
                        <i className="fas fa-shopping-cart"></i>
                        </div>
                        <a href="#" className="small-box-footer">
                        More info <i className="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            
                <div className="col-lg-3 col-6">
                    <div className="small-box bg-success">
                        <div className="inner">
                        <h3>53<sup style={{fontSize: "20px"}}>%</sup></h3>
        
                        <p>Bounce Rate</p>
                        </div>
                        <div className="icon">
                        <i className="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" className="small-box-footer">
                        More info <i className="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div className="col-lg-3 col-6">
                    <div className="small-box bg-warning">
                        <div className="inner">
                        <h3>44</h3>
                        <p>User Registrations</p>
                        </div>
                        <div className="icon">
                        <i className="fas fa-user-plus"></i>
                        </div>
                        <a href="#" className="small-box-footer">
                        More info <i className="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div className="col-lg-3 col-6">
                    <div className="small-box bg-danger">
                        <div className="inner">
                        <h3>65</h3>
                        <p>Unique Visitors</p>
                        </div>
                        <div className="icon">
                        <i className="fas fa-chart-pie"></i>
                        </div>
                        <a href="#" className="small-box-footer">
                        More info <i className="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        );
    }
}

export default Cards;


