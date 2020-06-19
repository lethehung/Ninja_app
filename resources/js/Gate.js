export default class Gate{

    constructor(user){
        this.user = user;
    }


    isAdmin(){
        return this.user.permission == 1;
    }

    isUser(){
        return this.user.permission == 1;
    }
    isAdminOrAuthor(){
        if(this.user.permission == 1 || this.user.permission == 1){
            return true;
        }

    }
    isAuthorOrUser(){
        if(this.user.permission == 1 || this.user.permission == 1){
            return true;
        }

    }



}

