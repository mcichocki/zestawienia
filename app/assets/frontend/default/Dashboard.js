import React from 'react';
import ReactDOM from 'react-dom';
import Logo from '../../images/logo.jpg';
import axios from 'axios';
import routing from '../website/routings';

class Dashboard extends React.Component
{
    state = {
        uzytkownicy: []
    }

    componentDidMount()
    {
        axios.get(routing.get('api_users')).then(res => {
            const uzytkownicy = res.data;
            this.setState({ uzytkownicy });
        });
    }

    render() {
        return(
        <div>
            <h1><i className="fas fa-edit"></i>Dashboard</h1>
            <img src={Logo} height="100" width="100" className="rounded-circle"/>
            <ul>
                { this.state.uzytkownicy.map(uzytkownik => <li key={uzytkownik.id} >{uzytkownik.login}</li>)}
            </ul>
        </div>);
    }
}

ReactDOM.render(<Dashboard/>, document.getElementById("dashboard"));

