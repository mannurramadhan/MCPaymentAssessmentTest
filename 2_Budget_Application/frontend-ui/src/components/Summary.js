import { useEffect, useState } from "react";
import Card from "./Card";
import "./Summary.css";

function Summary() {
    const [summary, setSummary] = useState([]);

    useEffect(() => {
        fetch("http://localhost:8000/api/account")
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                setSummary(data);
            })
            .catch((err) => {
                if (err.name === "AbortError") {
                    console.log("fetch aborted.");
                }
            });
    }, []);

    return (
        <div className="summary-container">
            <Card title="Balance" nominal={summary.balance} />
            <Card title="Income" nominal={summary.income} />
            <Card title="Expense" nominal={summary.expense} />
        </div>
    );
}

export default Summary;
