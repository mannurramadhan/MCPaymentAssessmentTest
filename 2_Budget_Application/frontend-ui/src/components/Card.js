import './Card.css';

function Card(props) {
    return (
        <div className="card-container">
            <h1>{props.title}</h1>
            <span className="bl-nominal">Rp. {props.nominal}</span>
        </div>
    );
}

export default Card;