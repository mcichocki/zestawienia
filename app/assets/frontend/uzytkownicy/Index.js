import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import routing from '../website/routings';
import { usePromiseTracker } from "react-promise-tracker";

class Index extends React.Component
{
    // https://www.basefactor.com/react-how-to-display-a-loading-indicator-on-fetch-calls
    state = {
        uzytkownicy: []
    }

    render() {
        return(
        <div className="container-fluid">
            <form id="frm-example" action="/path/to/your/script" method="POST">
                <table id="uzytkownicy" className="table table-striped table-white">
                <thead>
                    <tr className="text-center">
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Login</th>
                        <th>Rola</th>
                        <th>Biuro/Dzielnica</th>
                        <th>Aktywny</th>
                        <th>Akcja </th>
                    </tr>
                </thead>
                </table>
                <div id="send">
                    <hr/>
                    <p><button className="btn btn-sm btn-danger"><i className="fas fa-trash-alt"></i> Usuń zaznaczone</button></p>
                </div>
                <pre id="example-console"></pre>
            </form>
            {/* { this.state.jednostki.map(jednostka => <li key={jednostka.id}>{jednostka.nazwa}</li>)} */}
        </div>
        );
    }
}

ReactDOM.render(<Index/>, document.getElementById("uzytkownicy_index"));