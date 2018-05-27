import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ChatForm from './ChatForm';
import axios from 'axios';
import MessageList from './MessageList';

class Chat extends Component {

    constructor() {

    super();
    //Initialize the state in the constructor
      this.state = {
          showChat:false,
          BotonChat:false,
          messageList:[],
      },
      this.showChat = this.showChat.bind(this);
      this.scrollToBottom();

    }

    scrollToBottom = () => {
      let div = this.refs.chatbox;

      if(div){
        div.scrollTop = div.scrollHeight;
      }

    };

    componentDidMount() {
    /* fetch API in action */

      this.getMessage();      

    }
    componentDidUpdate (){
      const chatBox = this.chatBox;
      if(chatBox){
        chatBox.scrollTop = chatBox.scrollHeight;
      }

    }
    addMessage = (message) =>{

      this.setState({messageList: [...this.state.messageList, message]});
    }
    getMessage(){
        axios.get('/message')
          .then(response => {
            this.setState({ messageList: response.data});

          })
          .catch(function (error) {
            console.log(error);
        })
    }

    showChat(e){
      e.preventDefault()
      this.setState({ showChat: !this.state.showChat });
    }

    render () {

        const {messageList,showChat,BotonChat} = this.state;

        return (
          <div >
            { showChat &&
              <div className="chat">
                <div className="headChat">
                  <div className="">
                    <a href="#" onClick={this.showChat} className="botonChat btn btn-exit">
                      <i className="fa fa-times"></i>
                    </a>                    
                    <h4 className="headTitle">Estamos en linea para aclarar tus dudas</h4>
                  </div>
                  
                </div>
                <div ref={(el) => {this.chatBox = el}} className="chatBox">
                  <MessageList message={this.state.messageList} />
                </div>
              <ChatForm onAddMessage={this.addMessage}/>
              </div>
            }

            <div className="botonChat">
                <a href="#" onClick={this.showChat} className="btn btn-chat btn-circle"><i className="fa fa-comment"></i></a>
            </div>
          </div>

        );
    }
}
export default Chat;

  ReactDOM.render(<Chat />, document.getElementById('contChat'));
