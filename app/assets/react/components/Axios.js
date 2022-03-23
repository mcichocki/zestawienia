import React from 'react';
import axios from 'axios';

export class PersonList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            firstName: '',
            lastName: '',
            sysOp: '',
            persons: []
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }


    persons = axios.get('/react/api-users/get')
    .then(res => {
        const persons = res.data;
        this.setState({ persons });
    })

    handleChange(e) {
        this.setState({
            [e.target.name]: e.target.value,
            sysOp: e.target.value
        });
    }

    handleSubmit(e) {
        e.preventDefault();

        const user = {
            firstName: this.state.firstName,
            lastName: this.state.lastName,
            sysOp: this.state.sysOp
        };

        axios.post('/react/api-users/post', user )
            .then(res => {
                const persons = res.data;
                this.setState({ persons });
            })
    }

    render() {
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                    {/* Section input fields form */}
                    <label>
                        Imię:
                        <input type="text" name="firstName" className={"form-control"} onChange={this.handleChange} />
                    </label><br/>
                    <label>
                        Nazwisko:
                        <input type="text" name="lastName" className={"form-control"} onChange={this.handleChange} />
                    </label><br/>

                    {/*Section select field form */}
                    <label>
                        <select value={this.state.value} onChange={this.handleChange} className={"form-control"}>
                            <option value="windows">Windows</option>
                            <option value="linux">Linux</option>
                            <option value="macos">MacOS</option>
                            <option value="debian">Debian</option>
                        </select>
                    </label>

                    <button type="submit" className={"btn btn-sm btn-primary"}>Zapisz</button>
                </form>
                <br/><br/>
                <ul>
                    { this.state.persons.map(person =>
                        <li key={person.id}>{person.firstName} {person.lastName}: {person.sysOp}</li>
                    )}
                </ul>
            </div>
        )
    }
}