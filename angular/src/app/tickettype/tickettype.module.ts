import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TickettypeDetailComponent } from './components/tickettype-detail/tickettype-detail.component';
import { TickettypePageComponent } from './pages/tickettype-page/tickettype-page.component';

@NgModule({
  imports: [
    CommonModule
  ],
  declarations: [
    TickettypeDetailComponent, 
    TickettypePageComponent
  ],
  exports: [
    TickettypePageComponent
  ]
})
export class TickettypeModule { }
