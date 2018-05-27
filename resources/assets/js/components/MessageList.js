	
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Message from './Message';

class MessageList extends Component {


	render () {

        var messageList = this.props.message.map(function (message) {
          return (
                <Message author={message.author} time={message.created_at} content={message.content} ></Message>
                );
            });
        return (
          <ul className="chat-list">
            {messageList}
          </ul>
        );
    }


}

export default MessageList;
