import { NgModule } from '@angular/core';
import { CommonModule, DatePipe } from '@angular/common';
import { HeaderComponent } from './components/header/header.component';
import { MaterialModule } from '../material/material.module';
import { RouterModule } from '@angular/router';
import { MenuNavComponent } from './components/sidenav/menu-nav/menu-nav.component';
import { MenuCartComponent } from './components/sidenav/menu-cart/menu-cart.component';
import { FooterComponent } from './components/footer/footer.component';
import { SwappitService } from './services/swappit.service';
import { NotFoundPageComponent } from './pages/not-found-page/not-found-page.component';
import { PaginationService } from './services/pagination.service';
import { SwappitAuthService } from './services/swappit-auth.service';
import { SwappitAuthGuardService } from './services/swappit-auth-guard.service';
import { TicketDialogComponent } from './components/dialog/ticket-dialog/ticket-dialog.component';
import { OrderDialogComponent } from './components/dialog/order-dialog/order-dialog.component';
import { CartService } from './services/cart.service';
import { SidenavService } from './services/sidenav.service';
import { ParameterService } from './services/parameter.service';

@NgModule({
  imports: [
    CommonModule,
    MaterialModule,
    RouterModule
  ],
  declarations: [
    HeaderComponent, 
    MenuNavComponent, 
    MenuCartComponent, FooterComponent, NotFoundPageComponent, TicketDialogComponent, OrderDialogComponent
  ],
  exports: [
    MenuNavComponent,
    MenuCartComponent,
    HeaderComponent,
    FooterComponent
  ],
  providers: [
    SwappitService,
    PaginationService,
    SwappitAuthService,
    SwappitAuthGuardService,
    CartService,
    SidenavService,
    DatePipe,
    ParameterService
  ],
})
export class CoreModule { }
