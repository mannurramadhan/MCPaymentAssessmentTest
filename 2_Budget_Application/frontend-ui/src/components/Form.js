import { useEffect, useState } from "react";
import "./Form.css";
import Option from "./Option";

function Form() {
    const [input, setInput] = useState([]);
    const [category, setCategory] = useState([]);

    useEffect(() => {
        fetch("http://localhost:8000/api/transaction/category")
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                setCategory(data);
            })
            .catch((err) => {
                if (err.name === "AbortError") {
                    console.log("fetch aborted.");
                }
            });
    }, []);

    const submit = () => {
        const newInput = {input};

        fetch("http://localhost:8000/api/transaction", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(newInput),
        }).then(() => {
            setInput("");
        });
    };

    return (
        <div className="form-container">
            <h3>Entry Transaction</h3>
            <hr />
            <form onSubmit={submit}>
                <label htmlFor="transName">Transaction Name</label>
                <input
                    type="text"
                    id="transName"
                    value={input.transaction_name}
                    onChange={(e) => setInput(e.target.value)}
                    placeholder="e.g.: Buying a lunch.."
                />

                <label htmlFor="transType">Transaction Type</label>
                <select
                    id="transType"
                    value={input.transaction_category_id}
                    onChange={(e) => setInput(e.target.value)}
                >
                    {category.map((cat) => (
                        <Option cat={cat} key={cat.id} />
                    ))}
                </select>

                <label htmlFor="income">Income</label>
                <input
                    type="text"
                    id="income"
                    value={input.income}
                    onChange={(e) => setInput(e.target.value)}
                    placeholder="e.g.: 100000 (for 100.000,-)"
                />

                <label htmlFor="expense">Expense</label>
                <input
                    type="text"
                    id="expense"
                    value={input.expense}
                    onChange={(e) => setInput(e.target.value)}
                    placeholder="e.g.: 150000 (for 150.000,-)"
                />

                <label htmlFor="accountType">Account Type</label>
                <select
                    id="accountType"
                    value={input.account_type}
                    onChange={(e) => setInput(e.target.value)}
                >
                    <option value="Wallet">Wallet</option>
                    <option value="Bank Account">Bank Account</option>
                </select>

                <button type="submit" className="btn-submit">
                    Submit
                </button>
            </form>
        </div>
    );
}

export default Form;
