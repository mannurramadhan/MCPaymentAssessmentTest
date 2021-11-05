import "./Form.css";

function Form() {
    return (
        <div className="form-container">
            <h3>Entry Transaction</h3>
            <hr />
            <form>
                <label htmlFor="transName">Transaction Name</label>
                <input
                    type="text"
                    id="transName"
                    name="transaction_name"
                    placeholder="e.g.: Buying a lunch.."
                />

                <label htmlFor="transType">Transaction Type</label>
                <select id="transType" name="transaction_type">
                    <option value="1">Salary</option>
                    <option value="2">Phone</option>
                    <option value="3">Food</option>
                    <option value="4">Health</option>
                    <option value="5">Clothing</option>
                    <option value="6">Gift</option>
                    <option value="7">Pet</option>
                    <option value="8">Education</option>
                    <option value="9">Invesment</option>
                    <option value="10">Hobby</option>
                    <option value="11">Car</option>
                    <option value="12">Fitness</option>
                </select>

                <label htmlFor="income">Income</label>
                <input
                    type="text"
                    id="income"
                    name="income"
                    placeholder="e.g.: 100000 (for 100.000,-)"
                />

                <label htmlFor="expense">Expense</label>
                <input
                    type="text"
                    id="expense"
                    name="expense"
                    placeholder="e.g.: 150000 (for 150.000,-)"
                />

                <label htmlFor="accountType">Account Type</label>
                <select id="accountType" name="account_type">
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
