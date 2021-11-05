import './Form.css';

function Option({ cat }) {
    return (
        <option value={cat.id}>{cat.name}</option>
    );
}

export default Option;
