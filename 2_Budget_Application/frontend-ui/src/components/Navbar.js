import './Navbar.css';

function Navbar(props) {
    return (
        <nav>
            <div className="nav-logo">
                <h3>{props.nameApps}</h3>
            </div>
        </nav>
    );
}

export default Navbar;