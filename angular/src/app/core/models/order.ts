import { User } from "./user";
import { Ticket } from "./ticket";

export class Order {
  id: string;
  price: string;
  placed_at: string;
  payed_at: string;
  completed_at: string;
  cancelled_at: string;
  status: string;
  cancel_timer: string;
  user: User;
  tickets?: Array<Ticket>;

}