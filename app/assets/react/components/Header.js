import React from 'react';

export const Header = (props) => (
    <div className="content-header">
        <div className="container-fluid">
            <div className="row mb-2">
                <div className="col-sm-6">
                    <h5 style={{fontWeight: "bold"}}>{props.name}</h5>
                </div>
                <div className="col-sm-6">
                    <div className="float-sm-right">
                        <ol className="breadcrumb">
                            <li className={"breadcrumb-item"}><a href={"/"}>Strona domowa</a></li>
                            <li className={"breadcrumb-item"}><a href={"/react/app"}>Zestawienia</a></li>
                            <li className={"breadcrumb-item active"}>Dashboard</li>
                        </ol>
                        <span className="float-sm-right">Aktualna godzina: {props.date}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
);