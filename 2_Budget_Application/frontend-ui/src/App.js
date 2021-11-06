// import logo from './logo.svg';
import './App.css';
import Dashboard from './components/Dashboard';
import Form from './components/Form';
import Navbar from './components/Navbar';
import Table from './components/Table';

function App() {
  return (
    <div className="App">
      <Navbar nameApps="Budget Apps" />
      <div className="content-container header">
        <Dashboard title="Account Summary" />
      </div>
      <div className="content-container">
        <Table />
        <Form />
      </div>
    </div>
  );
}

export default App;
