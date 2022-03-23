import React from 'react';

class Form extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            fullname: '',
            email: '',
            password: '',
            fullnameError: '',
            emailError: '',
            passwordError: '',
            successMessage: '',
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        });
    }

    handleSubmit(e) {
        e.preventDefault();

        $.ajax({
            url: 'http://dev.stanmienia.v2/api/user',
            type: 'POST',
            data: {
                fullname: this.state.fullname,
                email: this.state.email,
                password: this.state.password
            },
            dataType: 'json',
            success: function(response) {
                this.setState({
                    fullnameError: response.fullnameError ? response.fullnameError : null,
                    emailError: response.emailError ? response.emailError : null,
                    passwordError: response.passwordError ? response.passwordError : null,
                    successMessage: response.success_message ? response.success_message : null,
                });
            }.bind(this),
            error: function(xhr) {
                console.log(`An error occured: ${xhr.status} ${xhr.statusText}`);
            }
        });
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit}>
                <div className="mb-3 mt-3">
                    <label htmlFor="fullname">Imię i nazwisko:</label>
                    <input type="text" name='fullname' className="form-control" value={this.state.fullname} onChange={this.handleChange} id="fullname" placeholder="Imię i nazwisko" />
                    <small>{this.state.fullnameError}</small>
                </div>

                <div className="mb-3">
                    <label htmlFor="email">Email:</label>
                    <input type="email" name='email' className="form-control" value={this.state.email} onChange={this.handleChange} id="email" placeholder="Email" />
                    <small>{this.state.emailError}</small>
                </div>

                <div className="mb-3">
                    <label htmlFor="password">Hasło:</label>
                    <input type="password" name='password' className="form-control" value={this.state.password} onChange={this.handleChange} id="password" placeholder="Hasło" />
                    <small>{this.state.passwordError}</small>
                </div>

                <div>
                    <button type="submit" className="btn btn-success">Sign up</button>
                    <span className='text-success'>{this.state.successMessage}</span>
                </div>
            </form>
        );
    }
}

export default Form;