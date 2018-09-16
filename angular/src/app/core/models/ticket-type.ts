import { Festival } from "./Festival";
import { Ticket } from "./ticket";

export class TicketType {
  id: string;
  name: string;
  tickets_wanted_count: string;
  tickets_available_count: string;
  tickets_sold_count: string;
  festival?: Festival = new Festival();
  tickets?: Array<Ticket>;
}