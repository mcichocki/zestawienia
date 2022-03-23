import React from 'react';
import ReactDOM from 'react-dom';

// Komponenty funkcyjne
import { Header } from './components/Header';
import { Content } from './components/Content';
import axios from "axios";


class ReactApp extends React.Component
{
    constructor(props) {
        super(props);
        this.state = {date: new Date()};
    }

    componentWillUnmount() {
        clearInterval(this.timerID);
    }

    tick() {
        this.setState({
            date: new Date()
        });
    }

    render()
    {
        return(
           <div>
              <Header name={"React App"} date={this.state.date.toLocaleTimeString()} />
               <Content/>
           </div>
        );
    }
}

ReactDOM.render(<ReactApp/>, document.getElementById("react_app"));


/*  -----------:::: Moje Notatki ::::-----------

Materiał do powtórzenia:
1. Jak exportować i importować funkcje
2. Słowa kluczowe export, import, const, let, var, default, this, super, props
a) export -
b) import -
c) const - Tworzy stałą, która może być globalna lub lokalna dla funkcji, która ją zadeklarowała. Zasady zasięgu dla stałych są takie same jak dla zmiennych.
d) let - Deklaracja zmiennej za pomocą let sprawia, że zmienna działa w kontekście blokowym, np. wewnątrz pętli.
e) var - Zmienne zadeklarowane za pomocą var działają w kontekście funkcji.


///////////////////////////
    Różnica między let i var
    Różnica polega na różnym zasięgu działania tak zadeklarowanej zmiennej. Konstrukcja var działa w kontekście funkcji, a let w kontekście bloku kodu.
////////////////////////////


3. Funkcja strzałkowa
3.1. Deklaracja (sposób 1)
function regular () {
    console.log('Bedekodzic.pl');
}
regular();

3.2. Deklaracja (sposób 2)
let regular = function () {
    console.log('Bedekodzic.pl');
};
regular();

3.3. Deklaracja (sposób 3)
let arrow = () =>{
    console.log('Bedekodzic.pl 2');
};
arrow();

3.4. Argumenty funkcji
let val;

let multi = function(a) {
    return val=a*2;
};
console.log(multi(3)); //6
console.log(val); //6

3.5 Funkcje (dwa argumenty)
Stary sposób:
let regular = function (a,b) {
    return a*b;
};
console.log(regular(5,4));

Nowy sposób:
let arrow2 = (a, b) => a+b;

console.log(arrow2(1,1));
*/