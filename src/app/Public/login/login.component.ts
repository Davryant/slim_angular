import { Component, OnInit } from '@angular/core';
import { ServiceService } from 'src/app/Service/service.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  private username = "";
  private password = "";

  constructor(private service : ServiceService, private router : Router) { }

  ngOnInit() {
  }

  onClickSignIn(){
    let data = {
      "username": this.username,
      "password": this.password
    }

    console.log(data);

    this.service.login(data).subscribe(response => {
      console.log(response);
  
      if(response['status']==='success') {
        this.router.navigate(['/home']);
      }else{
        
      }
      
    })
  }


}