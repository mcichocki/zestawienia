import React from 'react';
import ReactDOM from 'react-dom';

import Icons from './sections/Icons';
import Cards from './sections/Cards';
import Graphs from './sections/Graphs';

class Index extends React.Component
{
    render() {
        return(
        <div className="container-fluid">
            <Icons/>
            <Graphs/>
            {/* <Cards/> */}
        </div>
        );
    }
}

ReactDOM.render(<Index/>, document.getElementById("worker_index"));
