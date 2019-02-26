import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './Public/login/login.component';
import { RegisterComponent } from './Public/register/register.component';
import { AboutComponent } from './Public/about/about.component';
import { HomeComponent } from './Public/home/home.component';
import { DashboardComponent } from './Private/dashboard/dashboard.component';


const routes: Routes = [
  {path: '', component: LoginComponent},
  {path: 'login', component: LoginComponent},
  {path: 'register', component: RegisterComponent},
  {path: 'about', component: AboutComponent },
  {path: 'home', component: HomeComponent},
  {path: 'dashboard', component: DashboardComponent},

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
