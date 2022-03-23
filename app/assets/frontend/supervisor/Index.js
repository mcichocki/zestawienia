import React from 'react';
import ReactDOM from 'react-dom';

import Header from './Header';
import Content from './Content';

class Index extends React.Component
{
    render() {
        return(
            <div className="container-fluid">
                <Header/>
                <Content/>
            </div>
        );
    }
}

ReactDOM.render(<Index/>, document.getElementById("supervisor_index"));