<script type="text/x-template" id="chat-list-template">
<div class="messages-inbox">
<div class="messages-headline">
	<div class="input-with-icon">
			<input type="text" class="form-control" id="autocomplete-input" placeholder="Search" v-model="term">
		<span class="icon-feather-search"></span>
	</div>
</div>
<div class="attachScrollbar" data-simplebar>
<ul>
	<li v-for="chat_user in chatUserList" :class="{'active-message': active_chat && (chat_user.member_id==active_chat.member_id)}">
		<a href="#" @click.prevent="setActiveChat(chat_user)">
			<div class="message-avatar">
				<i class="status-icon" :class="{'status-online': chat_user.online_status, 'status-offline': !chat_user.online_status}"></i>
				<img :src="chat_user.avatar" alt="" />
			</div>

			<div class="message-by">
				<div class="message-by-headline">
					<h5>{{chat_user.name}}</h5>
					<span>{{chat_user.time}}</span>
				</div>
				<p v-if="chat_user.project_name.length > 0">{{chat_user.project_name}}</p>
				<p v-if="chat_user.unread_msg_count > 0"><b><span v-html="chat_user.message"></span></b> <span class="badge">{{chat_user.unread_msg_count}}</span></p>
				<p v-else><i class="icon-feather-check" v-if="chat_user.sender_id == login_user.member_id && chat_user.last_seen_msg >= chat_user.message_id"></i> <span v-html="chat_user.message"></span></p>
			</div>
		</a>
	</li>	
</ul>
</div>
</div>
</script>

<script type="text/javascript">
Vue.component('chat-list', {
  template: '#chat-list-template',
  props: ['last_time', 'new_message_received', 'active_chat', 'login_user'],
	data: function(){
	  return {
		chat_list: [],
		term: '',
	  }
	},
	beforeMount: function(){
	  this.loadChat();
	},
   mounted: function(){
	   
   },
   computed: {
	   chatUserList: function(){
		  var search_term = this.term;
		  var pattern = new RegExp(search_term, "gi");
		   return this.chat_list.filter(function(item){
			   return pattern.test(item.name);
		   });
	   }
   },
   watch: {
		last_time: function(newVal, oldVal){
			this.refreshChat();
		},
		new_message_received: function(newVal, oldVal){
			this.refreshChat();
		}
   },
  methods: {
	loadChat: function(){
		var _self = this;
		$.getJSON('<?php echo base_url('message/load_chat')?>', function(res){
			if(res.status == 1){
				res.chat_list.forEach(function(item){
					item.time = moment(item.sending_date, 'YYYY-MM-DD HH:mm:ss').fromNow();
					_self.chat_list.push(item);
				});
			}
		});
	},	
	setActiveChat: function(chat_user){
		chat_user.unread_msg_count = 0;
		/* this.active_chat = chat_user; */
		this.$emit('set-chat', chat_user);
	},
	refreshChat: function(){
		var _self = this;
		_self.chat_list = [];
		this.loadChat();
		
	}
  },
 
});
</script>


<script type="text/x-template" id="active-chat-header-template">
<div class="messages-headline">
	<h4><a :href="active_chat.profile_url" target="_blank">{{active_chat.name}}</a></h4>
	<p class="mb-0" v-if="active_chat.project_name.length > 0"><a :href="active_chat.project_url" target="_blank">{{active_chat.project_name}}</a></p>
	<a href="#" class="message-action" hidden><i class="icon-feather-trash-2"></i> Delete Conversation</a>
</div>
</script>

<script type="text/javascript">
Vue.component('active-chat-header', {
  template: '#active-chat-header-template',
  props: ['active_chat'],
});
</script>

<script type="text/x-template" id="active-chat-message-body-template">
<div class="justify-content-start">
<div class="message-content-inner" ref="message-inner" style="height:400px;">

	<infinite-loading direction="top" @infinite="infiniteHandler" ref="infiniteLoading"></infinite-loading>	
		<div v-for="message in message_list" :key="message.message_id">
			<!-- Time Sign -->
			<div class="message-time-sign" v-if="checkDate(message)">
				<span>{{message.sending_date | formatDate }}</span>
			</div>
			<div class="message-bubble" :class="{'me': message.sender_id == login_user.member_id}">
				<div class="message-bubble-inner">
					<div class="message-avatar" v-if="message.sender_id == login_user.member_id"><img :src="login_user.avatar" alt="" /></div>
					<div class="message-avatar" v-else><img :src="active_chat.avatar" alt="" /></div>					
					<div class="message-text edit-active_">																	
						<div v-if="message.attachment != null">
							<div class="message-attachment" v-if="message.attachment.is_image">
								<a :href="message.attachment.file_url" target="_blank"><img :src="message.attachment.file_url"  class="rounded attach-thumbnail" /></a>
							</div>
							<div class="message-attachment" v-else>
								<div><a :href="message.attachment.file_url" target="_blank" style="color: black">{{message.attachment.org_file_name}}</a></div>
								<div>Size: {{message.attachment.file_size | formatFileSize }}</div>
							</div>
						</div>
						<p>{{message.message}}
						<span class="time">
							{{message.sending_date | formatTime }} 
							<i class="icon-feather-check" v-if="message.sender_id == login_user.member_id && active_chat.last_seen_msg >= message.message_id"></i>
						</span>
						</p>
						<a href="javascript:void(0)" class="fav-star active_"><i class="icon-material-outline-star-border"></i></a>
						<div class="input-group message-edit-box">
							<input type="text" class="form-control" value="Edit text here">
							<div class="input-group-append"><button class="btn btn-outline-site"><i class="icon-feather-send"></i></button></div>
						</div>																	
					</div>
					<div class="dropdown edit-message">
						<a href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown"><i class="icon-feather-more-vertical"></i></a>	
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="javascript:void(0)"><i class="icon-feather-edit"></i> Edit</a>	
							<a class="dropdown-item" href="javascript:void(0)"><i class="icon-feather-trash"></i> Delete</a>	
							<a class="dropdown-item" href="javascript:void(0)"><i class="icon-line-awesome-quote-left"></i> Quote <i class="icon-line-awesome-quote-right"></i></a>	
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>		
		<div class="message-bubble me_" v-if="attachment_loading.loading">
			<div class="message-bubble-inner">
				<div class="message-avatar"><img :src="login_user.avatar" alt="" /></div>
					<div class="message-text" style="width:200px;">
					<div class="progress">
						  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
						  aria-valuemin="0" aria-valuemax="100" :style="{width: attachment_loading.progress+'%'}">
						  </div>
					</div>
					</div>
			</div>
			<div class="clearfix"></div>
		</div>		
		<!--
		<div class="message-bubble">
			<div class="message-bubble-inner">
				<div class="message-avatar"><img src="images/user-avatar-small-02.jpg" alt="" /></div>
				<div class="message-text">
					
					<div class="typing-indicator">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div> -->		
</div>
<reply-chat :active_chat="active_chat" :login_user="login_user" v-on:new-message="updateMessage" v-on:new-attachment="updateAttachment" v-on:progress="handleProgress" v-on:complete="handleComplete" v-on:start-upload="handleStartUpload"></reply-chat>
</div>
</script>

<script type="text/javascript">
var last_message_date = '';
Vue.component('active-chat-body', {
  template: '#active-chat-message-body-template',
  props: ['active_chat', 'login_user', 'new_message_received'],
  watch:{
	active_chat: function(newVal, oldVal){
		if(newVal != null){
			/* this.loadMessage(); */
			this.resetAll();
		}
	},
	new_message_received: function(newVal, oldVal){
		this.loadNewMessage();
	}
  },
  data: function(){
	  return {
		message_list: [],
		message_total: 0,
		next_limit: 0,
		updateScroll: false,
		message_date: '',
		attachment_loading: {
			loading: false,
			progress: 0,
		}
	  }
	  
  },
  filters: {
	 formatDate: function(val){
		return moment(val, 'YYYY-MM-DD HH:mm:ss').format('D MMMM,YY');
	 },
	 formatTime: function(val){
		return  moment(val, 'YYYY-MM-DD HH:mm:ss').format('h:mm A');
	 },
	 formatFileSize: function(val){
		var size;
		if(val < 1024){
			size = val + ' KB';
		}else{
			size = Math.round((val/1024)) + ' MB';
		} 
		
		return size;
	 }
  },
  
  methods: {
	handleStartUpload: function(){
		this.attachment_loading.loading = true;
		this.updateScroll = true;
	},
	handleProgress: function(progress){
		/* this.attachment_loading.loading = true; */
		this.attachment_loading.progress = progress;
	},
	handleComplete: function(){
		this.attachment_loading.loading = false;
		this.attachment_loading.progress = 0;		
	},
	checkDate: function(message){
		if(moment(message.sending_date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD') !== last_message_date){
			last_message_date = moment(message.sending_date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
			return true;
		}
		
		return false;
	},
	resetAll: function(){
		this.message_total = 0;
		this.next_limit = 0;
		this.message_list = [];
		this.$refs.infiniteLoading.stateChanger.reset();
	},
	
	loadMessage: function(){
		var _self = this,
			conversations_id = _self.active_chat.conversations_id;
		_self.message_list = [];
		$.getJSON('<?php echo base_url('message/load_chat_message')?>/'+conversations_id, function(res){
			if(res.status == 1){
				if(res.chat_message.length > 0){
					res.chat_message.forEach(function(item){
						if(item.attachment != null){
							item.attachment = JSON.parse(item.attachment);
						}
						_self.message_list.push(item);
					});
				}
				_self.message_total = res.chat_message_total;
				_self.next_limit = res.next_limit;
				
			}
		});
	} ,
	
	infiniteHandler: function($state){
		var _self = this,
			conversations_id = _self.active_chat.conversations_id;
		$.getJSON('<?php echo base_url('message/load_chat_message')?>/'+conversations_id, {limit: _self.next_limit}, function(res){
			if(res.status == 1){
				if(res.chat_message.length > 0){
					res.chat_message.forEach(function(item){
						if(item.attachment != null){
							item.attachment = JSON.parse(item.attachment);
						}
						_self.message_list.unshift(item);
					});
					
					_self.message_total = res.chat_message_total;
					_self.next_limit = res.next_limit;
					$state.loaded();
				}else{
					$state.complete();
				}	
				
			}
			
		});
		$('.message-content-inner').niceScroll();
	},
	
	loadNewMessage: function(){
		var _self = this,
			conversations_id = _self.active_chat.conversations_id;
		$.getJSON('<?php echo base_url('message/load_new_message')?>/'+conversations_id, function(res){
			if(res.status == 1){
				if(res.new_message.length > 0){
					var last_seen_msg;
					res.new_message.forEach(function(item){
						if(item.attachment != null){
							item.attachment = JSON.parse(item.attachment);
							_self.updateAttachment(item);
						}
						last_seen_msg = item.message_id;
						_self.message_list.push(item);
					});
					
					 _self.$emit('last-seen-msg', last_seen_msg);
					 /* _self.active_chat.last_seen_msg = last_seen_msg; */
					_self.updateScroll = true;
					
					
				}
				
			}
		});
	},
	
	updateMessage: function(msg){
		this.message_list.push(msg);
		this.$emit('update-message');
		this.updateScroll = true;
	},
	updateAttachment: function(attachment){
		this.$emit('new-attachment', attachment);
	},

	updateScrollPosition: function(){
		var scrollDiff = 0;
		var msgContainer = this.$refs['message-inner'];
		var scrollHeight = msgContainer.scrollHeight;
		var containerHeight = msgContainer.clientHeight;
		scrollDiff = scrollHeight - containerHeight;
		if(scrollDiff > 0){
			msgContainer.scrollTop = scrollDiff;
		}
	}
  },
  mounted: function(){
	//this.loadMessage();  
  },
  updated: function(){
	if(this.updateScroll){
		this.updateScrollPosition();
	}
	this.updateScroll = false;
  }
});
</script>

<script type="text/x-template" id="reply-chat-template">
<div>
	<div class="message-reply">
		<textarea class="form-control" cols="1" rows="1" placeholder="Your Message" data-autoresize v-model="message" @keypress.enter="sendOnEnter"></textarea>
		<div class="uploadButton">
			<input class="uploadButton-input" v-on:change="sendAttachment()" ref="file" type="file" accept="image/*, application/pdf" id="upload" multiple="">
			<label class="uploadButton-button ripple-effect" for="upload"><i class="icon-material-outline-attach-file"></i></label>
		</div>
		<button class="button ripple-effect" @click.prevent="sendMsg" :disabled="sent_status === 'sending'">Send</button>
		<div class="clearfix"></div>
	</div>
	<div class="chat-foot">
		<div class="checkbox">
			<input type="checkbox" v-model="send_on_enter" id="keyboard">
			<label for="keyboard" class="mb-0"><span class="checkbox-icon"></span> Use ENTER KEY to send message</label>
		</div>
	</div>
</div>
</script>

<script type="text/javascript">
Vue.component('reply-chat', {
  template: '#reply-chat-template',
  props: ['active_chat', 'login_user'],
  data: function(){
	  return {
		message:  '',	
		sent_status: 'sent',
		send_on_enter: false,
	  }
  },
  methods: {
	sendOnEnter: function($event){
		
		if(this.send_on_enter){
			$event.preventDefault();
			this.sendMsg();
		}
	},
	sendAttachment(){
		var _self = this;
		var file = this.$refs.file.files[0];
		var formData = new FormData();
		formData.append('file', file);
		
		formData.append('sender_id', _self.login_user.member_id);
		formData.append('conversations_id', _self.active_chat.conversations_id);
		formData.append('message', '');
		
		
		var sendAttachentURL = '<?php echo base_url('message/send_attachment'); ?>';
		
		var msg_data =  {
			message: '',
			sender_id: _self.login_user.member_id,
			conversations_id: _self.active_chat.conversations_id,
		};
		_self.sent_status = 'sending';
		_self.$emit('start-upload');
		$.ajax({
			  xhr: function() {
				var xhr = new window.XMLHttpRequest();

				xhr.upload.addEventListener("progress", function(evt) {
				  if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					percentComplete = parseInt(percentComplete * 100);
					_self.$emit('progress', percentComplete);

					if (percentComplete === 100) {
						_self.$emit('complete');
					}

				  }
				}, false);

				return xhr;
			  },
			  url: sendAttachentURL,
			  type: "POST",
			  data: formData,
			  dataType: "json",
			  contentType: false,
			  processData: false,
			  success: function(res) {
				if(res.status == 1){
					_self.message = '';
					_self.sent_status = 'sent';
					msg_data.sending_date = res.message_data.sending_date;
					msg_data.message_id = res.last_message_id;
					msg_data.attachment = res.attachment; 
					_self.$emit('new-message', msg_data);
					_self.$emit('new-attachment', msg_data);
				}
			  }
			  
		});
    },
	sendMsg: function(){
		var _self = this;
		if(_self.message.trim().length == 0){
			return;
		}
		
		// data to send to server
		var msg_data =  {
			message: _self.message.trim(),
			sender_id: _self.login_user.member_id,
			conversations_id: _self.active_chat.conversations_id,
		};
		
		
		_self.sent_status = 'sending';
		$.ajax({
			url: '<?php echo base_url('message/send_msg')?>',
			data: msg_data,
			type: 'POST',
			dataType: 'JSON',
			success: function(res){
				if(res.status == 1){
					_self.message = '';
					_self.sent_status = 'sent';
					msg_data.sending_date = res.message_data.sending_date;
					msg_data.message_id = res.last_message_id;
					_self.$emit('new-message', msg_data);
				}
			}			
		});
		
	}
  }
});
</script>

<script type="text/x-template" id="attachment-template">

<ul>
	<li v-for="(item, $index) in attachments" :key="$index">
		<a :href="item.attachment.file_url" target="_blank">			
			<h5>{{item.attachment.org_file_name}}</h5>
			<p>Date: {{item.sending_date | formatDate}}</p>
			<p>Size: {{item.attachment.file_size | formatFileSize}}</p>			
		</a>
	</li>
	<infinite-loading @infinite="loadAttachment" ref="infiniteLoading"></infinite-loading>
</ul>

</script>

<script type="text/javascript">
Vue.component('conversation-attachment', {
  template: '#attachment-template',
  props: ['active_chat', 'refresh_attachment'],
  data: function(){
	  return {
		attachments: [],
		next_limit: 0,
		attachment_total: 0,
		
	  }
  },
  watch: {
	refresh_attachment: function(new_val, old_val){
		if(new_val != null){
			this.attachments.unshift(new_val);
		}
		
	}  
  },
  filters: {
	 formatDate: function(val){
		return moment(val, 'YYYY-MM-DD HH:mm:ss').format('D MMMM,YY');
	 },
	 formatTime: function(val){
		return  moment(val, 'YYYY-MM-DD HH:mm:ss').format('h:mm A');
	 },
	 formatFileSize: function(val){
		var size;
		if(val < 1024){
			size = val + ' KB';
		}else{
			size = Math.round((val/1024)) + ' MB';
		} 
		
		return size;
	 }
  },
  methods: {
	resetAll: function(){
		this.attachment_total = 0;
		this.next_limit = 0;
		this.attachments = [];
		this.$refs.infiniteLoading.stateChanger.reset();
	},
	loadAttachment: function($state){
		var _self = this,
			conversations_id = _self.active_chat.conversations_id;
		$.getJSON('<?php echo base_url('message/load_attachments')?>/'+conversations_id, {limit: _self.next_limit}, function(res){
			if(res.status == 1){
				if(res.attachments.length > 0){
					res.attachments.forEach(function(item){
						_self.attachments.push(item);
					});
					
					_self.attachment_total = res.attachment_total;
					_self.next_limit = res.next_limit;
					$state.loaded();
				}else{
					$state.complete();
				}	
				
			}
			
		});
	},
  }
});

</script>