
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import io from "socket.io-client";
import axios from 'axios';



class ChatForm extends Component {

	constructor(props) {
    super(props);
	       /* Initialize the state. */
			this.state = {
			  newMessage: {
			      content: '',
			  },
			  textAreaMessage:'',
				room:'administrado'
			}




  }

		componentDidMount() {
			this.getRoom();
			console.log(this.state.room);
			const socket = io(':6001');

			socket.on('connect', function() {
   			socket.emit('room',this.state.room);
			}.bind(this));

	    socket.on('chat:message', function(data){
	    	addMessage(data);
	    });

	    const addMessage = data => {
	        this.props.onAddMessage(data);
					this.setState({ newMessage:{content:''}  });


      };

		}

		getRoom = () => {
			axios.get('/message/room')
				.then(response => {
					console.log(response);
					this.setState({ room: response.room});

				})
				.catch(function (error) {
					console.log(error);
			})
		}



	onChange = (e) => {
		this.setState({ newMessage:{content:e.target.value}  });

	}
	onClick = (e) => {
		if(this.state.newMessage.content != ''){
			axios.post('/message/store', this.state)
	        .then(response => {
	        	console.log(response);
	        })
	        .catch(error => {
	           console.log(error);
	        })
		}

	}
	onKeyPress = (e) => {
		if(e.key === 'Enter'){
			if(this.state.newMessage.content != ''){
				axios.post('/message/store', this.state)
		        .then(response => {
		        	console.log(response);
		        })
		        .catch(error => {
		           console.log(error);
		        })
			}
			e.preventDefault();
		}
	}


	render() {
    	return (
			<div className="chat-text">
				<form className="chat-form">
					<textarea onKeyPress={this.onKeyPress} onChange={this.onChange} value={this.state.newMessage.content} placeholder="Escribe un Mensaje aquí"></textarea>
					 <button type="button" onClick={this.onClick} className="btn btn-enviar btn-circle-enviar"><i className="fa fa-paper-plane"></i></button>
				</form>
			</div>
	    )
	}

}

export default ChatForm;
