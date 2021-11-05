// import logo from './logo.svg';
import './App.css';
import Form from './components/Form';
import Navbar from './components/Navbar';
import Table from './components/Table';

function App() {
  return (
    <div className="App">
      <Navbar nameApps="Budget Apps" />
      <div className="content-container">
        <Table />
        <Form />
      </div>
    </div>
  );
}

export default App;
