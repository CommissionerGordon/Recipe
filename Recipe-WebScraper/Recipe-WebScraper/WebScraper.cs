/*************************************************************************
 * CSC413 - Advanced Software Development I
 * Professor: James "The Commissioner" Gordon
 * Programmers: Amanda Jaynes, Jason Brown
 * WebScraper.cs
 * 
 * Team Recipe
 * 
 * This project is a webscraper used for obtaining data from the website
 * http://webtender.com in order to populate our database and display
 * the functionality of our web appliction. This project is purely for
 * educational purposes.
 * 
 * The word "DEBUG:"
 * at the beginning of certain comments is to make it easier to find
 * code that probably needs to be rewritten, re-designed, or possibly
 * eliminated altogether.
 *************************************************************************/

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Windows.Forms;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using System.Net;   // Allows us to make web requests
using System.Text.RegularExpressions; // Allows us to Split using Regex

namespace Recipe_WebScraper
{
    class WebScraper
    {
        /// <summary>
        /// Gets raw HTML web page source from the given URL.
        /// </summary>
        /// <param name="URL">The url of the web page containing either the recipe information,
        /// or the page with the list of individual recipe URL's</param>
        /// <returns>string</returns>
        public static string getSourceCode(string URL, bool checkBoxState)
        {
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(URL);
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            StreamReader source = new StreamReader(response.GetResponseStream());
            string sourceCode = source.ReadToEnd();
            string[] links = { };
            source.Close();
            response.Close();

            // Check to see if we are scraping links or just an individual recipe.
            if (checkBoxState == true) // Single recipe.
            {
                string recipeDetails = getRecipeDetails(sourceCode);
                sourceCode = recipeDetails;
            }
            else // DEBUG: Scrape links AND recipes?
            { 
                links = getLinksToScrape(sourceCode);
                for (int count = 0; count < 30; count++)
                {
                    sourceCode = getSourceCode(links[count], true);

                    // Write the sourceCode to a file
                    StreamWriter streamWrite = new StreamWriter("SQL_Query.txt", true);
                    streamWrite.Write(sourceCode);
                    streamWrite.Close();
                }
            }

            return sourceCode;
        }

        /// <summary>
        /// Allows for searching the HTML source after a certain key word or phrase.
        /// </summary>
        /// <param name="searchText"></param>
        /// <param name="value"></param>
        /// <returns>string OR null</returns>
        public static string textFollowing(string searchText, string value)
        {
            if (!String.IsNullOrEmpty(searchText) && !String.IsNullOrEmpty(value))
            {
                int index = searchText.IndexOf(value);
                if (-1 < index)
                {
                    int start = index + value.Length;
                    if (start <= searchText.Length)
                    {
                        return searchText.Substring(start);
                    }
                }
            }
            return null;
        }

        /// <summary>
        /// This method retrives all the links on a page (or in a frame,
        /// in the case of Webtender.com).
        /// </summary>
        /// <param name="sourceCode">The raw HTML source code from getSourceCode().</param>
        /// <returns>string</returns>
        public static string[] getLinksToScrape(string sourceCode)
        {
            string snipOfSourceCode = "";
            string linkRoot = "http://webtender.com";
            string links = "";
            string[] snipValue = {};
            int numLinks = TextTool.CountStringOccurrences(sourceCode, "<LI>");
            
            snipOfSourceCode = textFollowing(sourceCode, "<UL>");
            snipValue = snipOfSourceCode.Split('T');

            // Begins separating the link text.
            snipOfSourceCode = textFollowing(sourceCode, "<UL>");
            snipValue = Regex.Split(snipOfSourceCode, "</A>");

            // Builds each link into the snipValue array.
            for (int count = 0; count < numLinks; count++)
            {
                string[] temp = {};
                temp = Regex.Split(snipValue[count], "\"");
                snipValue[count] = linkRoot + temp[1];
            }
            // DEBUG: The following loop is for testing purposes.
            for (int count = 0; count < numLinks; count++)
            {
                links += snipValue[count];
            }

            return snipValue;
        }

        /// <summary>
        /// Carves out the recipe information: title, measurement of each ingredient,
        /// name of each ingredient, mixing instructions, and the "creator's comments",
        /// referred to in this method as "comments".
        /// </summary>
        /// <param name="sourceCode">This parameter comes from the getSourceCode() method
        /// and provides the raw HTML page source.</param>
        /// <returns>string[]</returns>
        public static string getRecipeDetails(string sourceCode)
        {
            string testString;
            string snipOfSourceCode;
            string smallSnip;
            string[] snipValue;
            string[] recipeDetails = {};
            string recipeSQLstatement = "INSERT INTO TestTable (recipeName, meas, ingrName, mixInstructions) VALUES (\"";
            
            // Gets recipe title
            try
            {
                // Gets recipe title.
                snipOfSourceCode = textFollowing(sourceCode, "<H1>");
                snipValue = snipOfSourceCode.Split('<');
                testString = recipeSQLstatement += snipValue[0] + "\", ";

                // Gets measurement of first ingredient
                smallSnip = textFollowing(sourceCode, "<LI>");
                snipValue = Regex.Split(smallSnip, " <A");
                recipeSQLstatement += "\"" + snipValue[0] + "\", ";

                // Gets name of first ingredient
                snipOfSourceCode = textFollowing(snipValue[1], ">");
                snipValue = Regex.Split(snipOfSourceCode, "</A");
                recipeSQLstatement += "\"" + snipValue[0] + "\", ";

                // Gets mixing instructions
                snipOfSourceCode = textFollowing(smallSnip, "<P>");
                snipValue = Regex.Split(snipOfSourceCode, "</P>");
                recipeSQLstatement += "\"" + snipValue[0] + "\"";
                
                recipeSQLstatement += ");";
            }
            catch
            {
                MessageBox.Show("It appears that you are scraping a links page \nwithout checking the box.",
                    "Error",
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Exclamation,
                    MessageBoxDefaultButton.Button1);
            }

            // Gets measurements and ingredients
            int numIngredients = TextTool.CountStringOccurrences(sourceCode, "<LI>");
            //numIngredients -= 5;
            numIngredients = 1; // DEBUG: Testing on a non-relational table

            for (int counter = 0; counter < numIngredients; counter++)
            {

            }

            return recipeSQLstatement;
        }

        public static string[] scrapeLinks(string linksURL)
        {
            string[] listoOfLinks = { };

            //// Gets list of links
            //snipOfSourceCode = textFollowing(sourceCode, "<LI>");
            //snipValue = Regex.Split(snipOfSourceCode, "<A");
            //snipOfSourceCode = snipValue[0];

            return listoOfLinks;
        }
    }
}