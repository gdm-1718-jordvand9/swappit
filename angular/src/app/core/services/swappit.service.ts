import { Injectable } from '@angular/core';

/*
Settings
*/
import { environment } from '../../../environments/environment';
import { HttpClient, HttpParams } from '@angular/common/http';
import { SwappitAuthService } from './swappit-auth.service';

/*
Models
*/
import { Festival } from '../models/Festival';
import { Ticket } from '../models/ticket';
import { User } from '../models/user';
import { TicketType } from '../models/ticket-type';
import { Order } from '../models/order';
import { ParameterService } from './parameter.service';

@Injectable()
export class SwappitService {

  constructor(private _httpClient: HttpClient, private _swappitAuthService: SwappitAuthService, private _parameterService: ParameterService) { }
  private _apiEndPointCheckoutPay = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints["checkout/pay"]}`
  private _apiEndPointCheckoutConfirmStore = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints["checkout/confirm/store"]}`
  private _apiEndPointCheckoutConfirmCreate = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints["checkout/confirm/create"]}`
  private _apiEndPointTicketTogglePublished = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints["tickets/toggle_published"]}`
  private _apiEndPointVMTicketTypeInfo = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.vm_ticket_types_info}`
  private _apiEndPointVMTicketType = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.vm_ticket_types}`;
  private _apiEndPointVMFestival = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.vm_festivals}`;
  private _apiEndPointTicketType = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.ticket_types}`;
  private _apiEndPointFestival = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.festivals}`;
  private _apiEndPointTicket = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.tickets}`;
  private _apiEndPointOrder = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.orders}`;
  private _apiEndPointAccount = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.account}`;
  private _apiEndPointAccountTickets = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.accountTickets}`;
  private _apiEndPointTicketBump = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.bumpTicket}`;

  getFestivals() {
    return this._httpClient.get<Array<Festival>>(`${this._apiEndPointFestival}`);
  }

  getFestivalById(id: string) {
    return this._httpClient.get<Festival>(`${this._apiEndPointFestival}/${id}`);
  }

  getTickets() {
    return this._httpClient.get<any>(`${this._apiEndPointTicket}`, { params: this._parameterService.getParametersFromUrl()});
  }

  getTicketsByPage(url: string) {
    return this._httpClient.get<any>(`${url}`);
  }

  getTicketById(id: string) {
    return this._httpClient.get<Ticket>(`${this._apiEndPointTicket}/${id}`);
  }

  getAccount() {
    return this._httpClient.get<User>(`${this._apiEndPointAccount}`);
  }

  setAccount(name: string, email: string) {
    let postData = {
      name: name,
      email: email,
    }
    return this._httpClient.patch(`${this._apiEndPointAccount}`, postData)
  }

  getAccountTickets() {
    return this._httpClient.get<any>(`${this._apiEndPointAccountTickets}`)
  }

  getAccountTicketsByPage(url: string) {
    return this._httpClient.get<any>(`${url}`);
  }

  getAccountOrders() {
    return this._httpClient.get<any>(`${this._apiEndPointOrder}`);
  }
  getAccountOrdersByPage(url: string) {
    return this._httpClient.get<any>(`${url}`)
  }
  
  getAccountOrderById(id: string) {
    return this._httpClient.get<Order>(`${this._apiEndPointOrder}/${id}`)
  }

  getTicketTypeById(id: string)
  {
    return this._httpClient.get<TicketType>(`${this._apiEndPointTicketType}/${id}`);
  }

  getVMFestivals()
  {
    return this._httpClient.get<Array<Festival>>(`${this._apiEndPointVMFestival}`);
  }

  getVMTicketType(festivalId: string)
  {
    return this._httpClient.get<Array<TicketType>>(`${this._apiEndPointVMTicketType}/${festivalId}`);
  }

  getVMTicketTypeInfo(id: string)
  {
    return this._httpClient.get<any>(`${this._apiEndPointVMTicketTypeInfo}/${id}`);
  }

  setTicket(ticket: Ticket)
  {
    let postData = {
      price: ticket.price,
      start_date: ticket.start_date,
      end_date: ticket.end_date,
      published: ticket.published,
      ticket_type: ticket.ticket_type.id,
      code: ticket.code,
    }
    return this._httpClient.post<Ticket>(`${this._apiEndPointTicket}`, postData)
  }

  setTicketTogglePublished(id: string)
  {
    return this._httpClient.patch<boolean>(`${this._apiEndPointTicketTogglePublished}/${id}`, {});
  }

  setTicketBump(id: string) {
    return this._httpClient.patch(`${this._apiEndPointTicketBump}/${id}`, {});
  }

  setTicketTypeWant(id: string) {
    return this._httpClient.post(`${this._apiEndPointTicketType}/want/${id}`, {});
  }
  
}
