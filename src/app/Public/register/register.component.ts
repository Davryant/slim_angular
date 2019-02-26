import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ServiceService } from 'src/app/Service/service.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  private firstname = "";
  private lastname = "";
  private username = "";
  private password = "";

  constructor(private service : ServiceService, private router : Router) { }

  ngOnInit() {
  }

  onClickRegister(){
    let user = {
      "firstname": this.firstname,
      "lastname": this.lastname,
      "username": this.username,
      "password": this.password
    }

    this.service.registerUser(user).subscribe(response => {
      console.log(response);

      this.router.navigate(['/']);
    })
}

}
