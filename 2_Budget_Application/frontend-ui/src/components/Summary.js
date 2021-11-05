import Card from './Card';
import './Summary.css';

function Summary() {
    return (
        <div className="summary-container">
            <Card title="Balance" nominal="1.000.000" />
            <Card title="Income" nominal="1.000.000" />
            <Card title="Expense" nominal="1.000.000" />
        </div>
    );
}

export default Summary;