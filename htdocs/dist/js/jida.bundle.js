import {React} from '../../modules/libs/react.development.js';
import {ReactDOM} from '../../modules/libs/react-dom.development.js';

console.log(React);
const App = () => {
    return React.createElement('div', null, React.createElement('h3', null, 'Hablame papi ', React.createElement('small', null, 'a ma motherfucker you know?')));
};

ReactDOM.render(React.createElement(App, null), document.getElementById('app'));