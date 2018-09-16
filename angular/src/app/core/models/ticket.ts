import { User } from "./user";
import { TicketType } from "./ticket-type";

export class Ticket {
  id: string;
  price: string;
  code: string;
  start_date: Date;
  end_date: Date;
  user: User;
  sold: boolean;
  published: boolean;
  ticket_type: TicketType = new TicketType();

}