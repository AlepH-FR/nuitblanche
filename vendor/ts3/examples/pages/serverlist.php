<?php

/**
 * @file
 * TeamSpeak 3 PHP Framework Example
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Sven 'ScP' Paulsen
 * @copyright Copyright (c) 2010 by Planet TeamSpeak. All rights reserved.
 */

try
{
  /* connect to server, login and get TeamSpeak3_Node_Host object by URI */
  $ts3_ServerInstance = TeamSpeak3::factory("serverquery://" . $cfg["user"] . ":" . $cfg["pass"] . "@" . $cfg["host"] . ":" . $cfg["query"] . "/");

  /* access server instance address using __toString() */
  echo "<h1>Virtual Server List - " . $ts3_ServerInstance . "</h1>\n";

  /* iterate through host and list virtual servers */
  echo "<table class=\"list\">\n";
  echo "<tr>\n" .
       "  <th>ID</th>\n" .
       "  <th>Name</th>\n" .
       "  <th>Status</th>\n" .
       "  <th>Uptime</th>\n" .
       "  <th>Unique Identifier</th>\n" .
       "  <th>Clients Online</th>\n" .
       "  <th>Network Port</th>\n" .
       "</tr>\n";
  foreach($ts3_ServerInstance as $ts3_VirtualServer)
  {
    echo "<tr>\n" .
         "  <td>" . $ts3_VirtualServer->getId() . "</td>\n" .
         "  <td><a href=\"?page=serverinfo&amp;server=" . $ts3_VirtualServer["virtualserver_id"] . "\">" . htmlspecialchars($ts3_VirtualServer) . "</a></td>\n" .
         "  <td>" . $ts3_VirtualServer["virtualserver_status"] . "</td>\n" .
         "  <td>" . ($ts3_VirtualServer->isOffline() ? "-" : TeamSpeak3_Helper_Convert::seconds($ts3_VirtualServer["virtualserver_uptime"], FALSE)) . "</td>\n" .
         "  <td>" . $ts3_VirtualServer["virtualserver_unique_identifier"] . "</td>\n" .
         "  <td>" . ($ts3_VirtualServer->isOffline() ? "- / -" : $ts3_VirtualServer->clientCount() . " / " . $ts3_VirtualServer["virtualserver_maxclients"]) . "</td>\n" .
         "  <td>" . $ts3_VirtualServer["virtualserver_port"] . "</td>\n" .
         "</tr>\n";
  }
  echo "</table>\n";

  /* display runtime from adapter profiler */
  echo "<p>Executed " . $ts3_ServerInstance->getAdapter()->getQueryCount() . " queries in " . $ts3_ServerInstance->getAdapter()->getQueryRuntime() . " seconds</p>\n";
}
catch(Exception $e)
{
  /* catch exceptions and display error message if anything went wrong */
  echo "<span class='error'><b>Error " . $e->getCode() . ":</b> " . $e->getMessage() . "</span>\n";
}
