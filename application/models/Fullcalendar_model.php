<?php


class Fullcalendar_model extends CI_Model
{
    function fetch_all_eventtt()
    {
        $this->db->order_by('id');
        return $this->db->get('calendar');
    }

    public function fetch_all_event($where = array(), $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get('calendar');
    }

    public function fetch_all_event_result($where = array(), $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get('calendar')->result();
    }

    function insert_event($data)
    {
        return $this->db->insert('calendar', $data);
    }

    function update_event($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('calendar', $data);
    }

    function delete_event($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('calendar');
    }

    function update_resize_event($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('calendar', $data);
    }


    public function get($where = array())
    {
        return $this->db->where($where)->get("calendar")->row();
    }

    public function get_all($where = array(), $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get('calendar')->result();
    }


    public function add($data = array())
    {
//        if (isAllowedWriteModule())
            return $this->db->insert("calendar", $data);
//        else
//            return false;
    }

    public function update($where = array(), $data = array())
    {
//        if (isAllowedUpdateModule())
            return $this->db->where($where)->update("calendar", $data);
//        else
//            return false;
    }

    public function delete($where = array())
    {
//        if (isAllowedDeleteModule())
            return $this->db->where($where)->delete("calendar");
//        else
//            return false;
    }

    public function get_all_list($where = array(), $order = "id ASC", $limit = array("count" => 0, "start" => 0))
    {

        $this->db->where($where)->order_by($order);

        if(!empty($limit))
            $this->db->limit($limit["count"], $limit["start"]);

        return $this->db->get("calendar")->result();
    }
}
