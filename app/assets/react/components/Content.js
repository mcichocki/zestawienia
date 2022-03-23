import React from 'react';

import {Docs} from "./Docs";
import Formularz from "./Formularz";
import SignUp from "./SignUp";
import {PersonList} from "./Axios";
import Select from "./Select";

export function Content() {
    return(
        <div className="container-fluid" style={{color: "#172b4d"}}>
            <div className="content-header">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card card-primary">
                            <div className="card-body" style={{display: "block"}}>
                                <Docs/>
                                <br/>
                                <Select/>
                                <br/>
                                <hr/>
                                <Formularz/>  {/*Prosty formularz*/}
                                <hr/><br/>
                                <span><b>Rejestrowanie nowego użytkownika</b></span>
                                <br/>
                                <SignUp/>
                                <br/>
                                <PersonList/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
