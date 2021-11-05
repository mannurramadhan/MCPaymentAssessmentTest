import "./Table.css";

function Table() {
    return (
        <div className="table-container">
            <h3>List Transaction</h3>
            <hr/>
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
                    <tr>
                        <td>1</td>
                        <td>Buying a lunch</td>
                        <td>Food</td>
                        <td>0</td>
                        <td>56.000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Washing car</td>
                        <td>Car</td>
                        <td>0</td>
                        <td>100.000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Monthly Salary</td>
                        <td>Salary</td>
                        <td>7.000.000</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    );
}

export default Table;
