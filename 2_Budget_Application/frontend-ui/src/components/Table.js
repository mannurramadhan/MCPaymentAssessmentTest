import { useEffect, useState } from "react";
import "./Table.css";
import Tr from "./TrTd";

function Table() {
    const [trans, setTrans] = useState([]);

    useEffect(() => {
        fetch("http://localhost:8000/api/transaction")
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                setTrans(data);
            })
            .catch((err) => {
                if (err.name === "AbortError") {
                    console.log("fetch aborted.");
                }
            });
    }, []);

    return (
        <div className="table-container">
            <h3>List Transaction</h3>
            <hr />
            <table className="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Income</th>
                        <th>Expense</th>
                    </tr>
                </thead>
                <tbody>
                    {trans.map((tr) => (
                        <Tr tr={tr} key={tr.id} />
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default Table;
