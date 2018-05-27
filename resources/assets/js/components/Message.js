
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import TimeAgo from './TimeAgo';

class Message extends Component {


	render() {
	    return (	    	
			<li>
				<div className="chat-img"><img src="./images/8.jpg" alt="user" /></div>
				<div className="chat-content">
					 <h5>{this.props.author}</h5>
					 <div className="box usuario">{this.props.content}</div>
				</div>
				<div className="chat-time">10:56 am</div>
		 	</li>
	    );
	}
}

export default Message;
