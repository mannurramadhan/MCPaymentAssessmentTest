import "./Table.css";

function TrTd({ tr }) {
    return (
        <tr>
            <td className="align-center">{tr.id}</td>
            <td>{tr.transaction_name}</td>
            <td className="align-center">{tr.transaction_category}</td>
            <td>{tr.income}</td>
            <td>{tr.expense}</td>
        </tr>
    );
}

export default TrTd;
