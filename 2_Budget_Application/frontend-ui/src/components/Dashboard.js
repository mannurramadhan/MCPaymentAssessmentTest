import './Dashboard.css';
import Summary from './Summary';

function Dashboard(props) {
    return (
        <div className="dashboard-container">
            <h3>{props.title}</h3>
            <hr/>
            <Summary />
        </div>
    );
}

export default Dashboard;