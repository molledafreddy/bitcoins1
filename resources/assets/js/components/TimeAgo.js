
import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class TimeAgo extends Component {

	render() {
	    return (
	      <li className="message">
	      	<strong>{this.props.name}:</strong> 
	      	{this.props.children} <TimeAgo>{this.props.time}</TimeAgo></li>
	    );
	}
}

export default TimeAgo;