import { User } from "./user";
import { Ticket } from "./ticket";
import { TicketType } from "./ticket-type";
import { Festival } from "./Festival";

export class CartItem {
  ticketId: string;
  ticket_type: TicketType;
  price: string;
  user: User;

  public setTicketType(id: string, name: string): void {
    this.ticket_type = { id: id, name: name }
  }

  public setFestival(id: string, name: string): void {
    this.ticket_type.festival = { id: id, name: name }
  }

  public setUser(id: string, name: string): void {
    this.user = { id: id, name: name }
  }
}